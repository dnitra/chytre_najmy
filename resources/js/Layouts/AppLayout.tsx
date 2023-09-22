import { router } from "@inertiajs/core";
import { Head } from "@inertiajs/react";
import React, { PropsWithChildren, useState } from "react";
import useRoute from "@/Hooks/useRoute";
import useTypedPage from "@/Hooks/useTypedPage";
import Banner from "@/Components/Banner";
import { Team, AppLayoutProps } from "@/types";
import PrimaryNavigation from "@/Components/PrimaryNavigation";
import ResponsiveNavigation from "@/Components/ResponsiveNavigation";
import Hamburger from "@/Components/Hamburger";

export default function AppLayout({
    title,
    subtitle,
    children,
}: PropsWithChildren<AppLayoutProps>) {
    const page = useTypedPage();
    const route = useRoute();
    const [showingNavigationDropdown, setShowingNavigationDropdown] =
        useState(false);

    function switchToTeam(e: React.FormEvent, team: Team) {
        e.preventDefault();
        console.log("switching to team", team);
        router.get(
            route("update-user-curent-team"),
            {
                team_id: team.id,
            },
            {
                preserveState: false,
            }
        );
    }
    function logout(e: React.FormEvent) {
        e.preventDefault();
        router.post(route("logout"));
    }

    return (
        <div>
            <Head title={title} />

            <Banner />

            {/* Navigation */}

            <div className="min-h-screen bg-gray-100">
                <nav className="bg-white border-b border-gray-100">
                    {/* Primary Navigation */}

                    <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                        <div className="flex justify-between h-16">
                            <PrimaryNavigation
                                logout={logout}
                                switchToTeam={switchToTeam}
                            />

                            <Hamburger
                                showingNavigationDropdown={
                                    showingNavigationDropdown
                                }
                                setShowingNavigationDropdown={
                                    setShowingNavigationDropdown
                                }
                            />
                        </div>
                    </div>

                    {/* Responsive Navigation */}

                    <ResponsiveNavigation
                        logout={logout}
                        switchToTeam={switchToTeam}
                        showingNavigationDropdown={showingNavigationDropdown}
                    />
                </nav>

                {/* <!-- Page Heading --> */}

                <header className="bg-white shadow">
                    <div className="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        <h2 className="font-semibold text-xl text-gray-800 leading-tight">
                            {subtitle}
                        </h2>
                    </div>
                </header>

                {/* <!-- Flash Messages --> */}
                {page.props.flash.success ? (
                    <div
                        className="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative"
                        role="alert"
                    >
                        <strong className="font-bold">Success! </strong>
                        <span className="block sm:inline">
                            {page.props.flash.success}
                        </span>
                    </div>
                ) : null}

                {page.props.flash.error ? (
                    <div
                        className="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative"
                        role="alert"
                    >
                        <strong className="font-bold">Error! </strong>
                        <span className="block sm:inline">
                            {page.props.flash.error}
                        </span>
                    </div>
                ) : null}

                {/* <!-- Page Content --> */}
                <main>{children}</main>
            </div>
        </div>
    );
}
