import React from "react";
import ApplicationLogo from "@/Components/ApplicationLogo";

export default function Welcome() {
    return (
        <div>
            <div className="p-6 lg:p-8 bg-white border-b border-gray-200">
                <ApplicationLogo className="block h-12 w-auto" />

                <h1 className="mt-8 text-2xl font-medium text-gray-900">
                    This is the dashboard
                </h1>
                <div >
                    <p className="mt-4 text-gray-600">

                    </p>
                </div>
            </div>



        </div>
    );
}
