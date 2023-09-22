import CreateTeamForm from "@/Pages/Teams/Partials/CreateTeamForm";
import AppLayout from "@/Layouts/AppLayout";
import React from "react";

export default function Create() {
    return (
        <AppLayout title="Manage Team" subtitle="Create Team">
            <div>
                <div className="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
                    <CreateTeamForm />
                </div>
            </div>
        </AppLayout>
    );
}
