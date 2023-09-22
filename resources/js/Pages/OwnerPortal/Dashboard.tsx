import React from "react";
import Welcome from "@/Components/Welcome";
import AppLayout from "@/Layouts/AppLayout";

export default function Dashboard() {
    return (
        <AppLayout title="Dashboard" subtitle="Dashboard">
            <div className="py-12">
                <div className="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div className="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                        <Welcome />
                    </div>
                </div>
            </div>
        </AppLayout>
    );
}
