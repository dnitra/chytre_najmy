import { router } from "@inertiajs/core";
import { Link } from "@inertiajs/react";
import React from "react";
import ApplicationMark from "./ApplicationMark";
import Dropdown from "./Dropdown";
import DropdownLink from "./DropdownLink";
import NavLink from "./NavLink";
import useRoute from "@/Hooks/useRoute";
import useTypedPage from "@/Hooks/useTypedPage";
import { Navigation } from "@/types";

export default function PrimaryNavigation({
    logout,
    switchToTeam,
}: Navigation) {
    const page = useTypedPage();
    const route = useRoute();

    return (
        <>
            <div className="flex">
                {/* <!-- Logo --> */}
                <div className="flex-shrink-0 flex items-center">
                    <Link href={route("dashboard")}>
                        <ApplicationMark className="block h-9 w-auto" />
                    </Link>
                </div>

                {/* <!-- Navigation Links --> */}
                <div className="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <NavLink
                        href={route("dashboard")}
                        active={route().current("dashboard")}
                    >
                        Dashboard
                    </NavLink>
                    <NavLink
                        href={
                            page.props.myProperties.length > 0
                                ? route("my-properties.show", [
                                      page.props.auth.user
                                          .last_visited_property_id
                                          ? page.props.auth.user
                                                .last_visited_property_id
                                          : page.props.myProperties[0].id,
                                  ])
                                : route("my-properties.index")
                        }
                        active={route().current("my-properties.show")}
                    >
                        My Properties
                    </NavLink>
                </div>
            </div>

            <div className="hidden sm:flex sm:items-center sm:ml-6">
                <div className="ml-3 relative">
                    {/* <!-- Teams Dropdown --> */}
                    {page.props.jetstream.hasTeamFeatures ? (
                        <Dropdown
                            align="right"
                            width="60"
                            renderTrigger={() => (
                                <span className="inline-flex rounded-md">
                                    <button
                                        type="button"
                                        className="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none focus:bg-gray-50 active:bg-gray-50 transition ease-in-out duration-150"
                                    >
                                        {
                                            page.props.auth.user?.current_team
                                                ?.name
                                        }

                                        <svg
                                            className="ml-2 -mr-0.5 h-4 w-4"
                                            xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 20 20"
                                            fill="currentColor"
                                        >
                                            <path
                                                fillRule="evenodd"
                                                d="M10 3a1 1 0 01.707.293l3 3a1 1 0 01-1.414 1.414L10 5.414 7.707 7.707a1 1 0 01-1.414-1.414l3-3A1 1 0 0110 3zm-3.707 9.293a1 1 0 011.414 0L10 14.586l2.293-2.293a1 1 0 011.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z"
                                                clipRule="evenodd"
                                            />
                                        </svg>
                                    </button>
                                </span>
                            )}
                        >
                            <div className="w-60">
                                {/* <!-- Team Management --> */}
                                {page.props.jetstream.hasTeamFeatures ? (
                                    <>
                                        <div className="block px-4 py-2 text-xs text-gray-400">
                                            Manage Team
                                        </div>

                                        {/* <!-- Team Settings --> */}
                                        <DropdownLink
                                            href={route("teams.show", [
                                                page.props.auth.user
                                                    ?.current_team!,
                                            ])}
                                        >
                                            Portfolio Settings
                                        </DropdownLink>

                                        {page.props.jetstream.canCreateTeams ? (
                                            <DropdownLink
                                                href={route("teams.create")}
                                            >
                                                Create New Portfolio
                                            </DropdownLink>
                                        ) : null}

                                        <div className="border-t border-gray-200" />

                                        {/* <!-- Team Switcher --> */}
                                        <div className="block px-4 py-2 text-xs text-gray-400">
                                            Switch Portfolio
                                        </div>

                                        {page.props.auth.user?.all_teams?.map(
                                            (team) => (
                                                <form
                                                    onSubmit={(e) =>
                                                        switchToTeam(e, team)
                                                    }
                                                    key={team.id}
                                                >
                                                    <DropdownLink as="button">
                                                        <div className="flex items-center">
                                                            {team.id ==
                                                                page.props.auth
                                                                    .user
                                                                    ?.current_team_id && (
                                                                <svg
                                                                    className="mr-2 h-5 w-5 text-green-400"
                                                                    fill="none"
                                                                    strokeLinecap="round"
                                                                    strokeLinejoin="round"
                                                                    strokeWidth="2"
                                                                    stroke="currentColor"
                                                                    viewBox="0 0 24 24"
                                                                >
                                                                    <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                                </svg>
                                                            )}
                                                            <div>
                                                                {team.name}
                                                            </div>
                                                        </div>
                                                    </DropdownLink>
                                                </form>
                                            )
                                        )}
                                    </>
                                ) : null}
                            </div>
                        </Dropdown>
                    ) : null}
                </div>

                {/* <!-- Settings Dropdown --> */}
                <div className="ml-3 relative">
                    <Dropdown
                        align="right"
                        width="48"
                        renderTrigger={() =>
                            page.props.jetstream.managesProfilePhotos ? (
                                <button className="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition">
                                    <img
                                        className="h-8 w-8 rounded-full object-cover"
                                        src={
                                            page.props.auth.user
                                                ?.profile_photo_url
                                        }
                                        alt={page.props.auth.user?.name}
                                    />
                                </button>
                            ) : (
                                <span className="inline-flex rounded-md">
                                    <button
                                        type="button"
                                        className="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none focus:bg-gray-50 active:bg-gray-50 transition ease-in-out duration-150"
                                    >
                                        {page.props.auth.user?.name}

                                        <svg
                                            className="ml-2 -mr-0.5 h-4 w-4"
                                            xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 20 20"
                                            fill="currentColor"
                                        >
                                            <path
                                                strokeLinecap="round"
                                                strokeLinejoin="round"
                                                d="M19.5 8.25l-7.5 7.5-7.5-7.5"
                                            />
                                        </svg>
                                    </button>
                                </span>
                            )
                        }
                    >
                        {/* <!-- Account Management --> */}
                        <div className="block px-4 py-2 text-xs text-gray-400">
                            Manage Account
                        </div>

                        <DropdownLink href={route("profile.show")}>
                            Profile
                        </DropdownLink>

                        {page.props.jetstream.hasApiFeatures ? (
                            <DropdownLink href={route("api-tokens.index")}>
                                API Tokens
                            </DropdownLink>
                        ) : null}

                        <div className="border-t border-gray-200"></div>

                        {/* <!-- Authentication --> */}
                        <form onSubmit={logout}>
                            <DropdownLink as="button">Log Out</DropdownLink>
                        </form>
                    </Dropdown>
                </div>
            </div>
        </>
    );
}
