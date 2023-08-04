import React from "react";
import AppLayout from "@/Layouts/AppLayout";
import Index from "@/Pages/OwnerPortal/MyProperties/Index";
import Show from "@/Pages/OwnerPortal/MyProperties/Show";

interface Props {
    properties: any;
}
export default function MyProperties({ properties }: Props) {
    return (
        <AppLayout
            title="My Properties"
            renderHeader={() => (
                <h2 className="font-semibold text-xl text-gray-800 leading-tight">
                    My Properties
                </h2>
            )}
        >
            <div className="py-12">
                <div className="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div className="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                        <div className="flex p-6 lg:p-8">
                            <Index />
                            <div className="p-6">
                                {/* show different content  */}
                                <Show />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </AppLayout>
    );
}
