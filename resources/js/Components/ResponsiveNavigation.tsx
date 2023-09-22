import classNames from "classnames";
import React from "react";
import ResponsiveNavLink from "./ResponsiveNavLink";
import useRoute from "@/Hooks/useRoute";
import useTypedPage from "@/Hooks/useTypedPage";
import { Navigation } from "@/types";

export default function ResponsiveNavigation({
    logout,
    switchToTeam,
    showingNavigationDropdown,
}: Navigation) {
    const page = useTypedPage();
    const route = useRoute();

    return (
        <div
            className={classNames("sm:hidden", {
                block: showingNavigationDropdown,
                hidden: !showingNavigationDropdown,
            })}
        >
            <div className="pt-2 pb-3 space-y-1">
                <ResponsiveNavLink
                    href={route("dashboard")}
                    active={route().current("dashboard")}
                >
                    Dashboard
                </ResponsiveNavLink>
                <ResponsiveNavLink
                    href={
                        page.props.myProperties.length > 0
                            ? route("my-properties.show", [
                                  page.props.auth.user.last_visited_property_id
                                      ? page.props.auth.user
                                            .last_visited_property_id
                                      : page.props.myProperties[0].id,
                              ])
                            : route("my-properties.index")
                    }
                    active={route().current("my-properties.show")}
                >
                    My Properties
                </ResponsiveNavLink>
            </div>

            {/* <!-- Responsive Settings Options --> */}
            <div className="pt-4 pb-1 border-t border-gray-200">
                <div className="flex items-center px-4">
                    {page.props.jetstream.managesProfilePhotos ? (
                        <div className="flex-shrink-0 mr-3">
                            <img
                                className="h-10 w-10 rounded-full object-cover"
                                src={page.props.auth.user?.profile_photo_url}
                                alt={page.props.auth.user?.name}
                            />
                        </div>
                    ) : null}

                    <div>
                        <div className="font-medium text-base text-gray-800">
                            {page.props.auth.user?.name}
                        </div>
                        <div className="font-medium text-sm text-gray-500">
                            {page.props.auth.user?.email}
                        </div>
                    </div>
                </div>

                <div className="mt-3 space-y-1">
                    <ResponsiveNavLink
                        href={route("profile.show")}
                        active={route().current("profile.show")}
                    >
                        Profile
                    </ResponsiveNavLink>

                    {page.props.jetstream.hasApiFeatures ? (
                        <ResponsiveNavLink
                            href={route("api-tokens.index")}
                            active={route().current("api-tokens.index")}
                        >
                            API Tokens
                        </ResponsiveNavLink>
                    ) : null}

                    {/* <!-- Authentication --> */}
                    <form method="POST" onSubmit={logout}>
                        <ResponsiveNavLink as="button">
                            Log Out
                        </ResponsiveNavLink>
                    </form>

                    {/* <!-- Team Management --> */}
                    {page.props.jetstream.hasTeamFeatures ? (
                        <>
                            <div className="border-t border-gray-200"></div>

                            <div className="block px-4 py-2 text-xs text-gray-400">
                                Manage Team
                            </div>

                            {/* <!-- Team Settings --> */}
                            <ResponsiveNavLink
                                href={route("teams.show", [
                                    page.props.auth.user?.current_team!,
                                ])}
                                active={route().current("teams.show")}
                            >
                                Team Settings
                            </ResponsiveNavLink>

                            {page.props.jetstream.canCreateTeams ? (
                                <ResponsiveNavLink
                                    href={route("teams.create")}
                                    active={route().current("teams.create")}
                                >
                                    Create New Team
                                </ResponsiveNavLink>
                            ) : null}

                            <div className="border-t border-gray-200"></div>

                            {/* <!-- Team Switcher --> */}
                            <div className="block px-4 py-2 text-xs text-gray-400">
                                Switch Teams
                            </div>
                            {page.props.auth.user?.all_teams?.map((team) => (
                                <form
                                    onSubmit={(e) => switchToTeam(e, team)}
                                    key={team.id}
                                >
                                    <ResponsiveNavLink as="button">
                                        <div className="flex items-center">
                                            {team.id ==
                                                page.props.auth.user
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
                                            <div>{team.name}</div>
                                        </div>
                                    </ResponsiveNavLink>
                                </form>
                            ))}
                        </>
                    ) : null}
                </div>
            </div>
        </div>
    );
}
