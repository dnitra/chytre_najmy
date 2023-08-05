import React from "react";
import MyProperties from "../MyProperties";
import { usePage } from "@inertiajs/react";
import AppLayout from "@/Layouts/AppLayout";

const Show = () => {
    const { auth, property } = usePage().props;

    console.log("last visited property:");
    console.log(auth.user.last_visited_property_id);
    console.log("current property:");
    console.log(property);
    return <h1>Show Detail of Property</h1>;
};

Show.layout = (page: any) => (
    <AppLayout
        title="My Properties"
        activeProperty={page.props.id}
        renderHeader={() => (
            <h2 className="font-semibold text-xl text-gray-800 leading-tight">
                My Properties
            </h2>
        )}
    >
        <MyProperties children={page} />
    </AppLayout>
);
export default Show;
