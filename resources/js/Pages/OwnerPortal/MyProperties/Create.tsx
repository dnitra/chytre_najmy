import React from "react";
import MyProperties from "../MyProperties";
import AppLayout from "@/Layouts/AppLayout";

const Create = () => {
    return <h1>Create/Edit Form</h1>;
};

Create.layout = (page: any) => (
    <AppLayout
        title="My Properties"
        renderHeader={() => (
            <h2 className="font-semibold text-xl text-gray-800 leading-tight">
                My Properties
            </h2>
        )}
    >
        <MyProperties children={page} />
    </AppLayout>
);

export default Create;
