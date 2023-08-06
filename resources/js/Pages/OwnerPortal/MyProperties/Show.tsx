import React from "react";
import MyProperties from "../MyProperties";
import { usePage } from "@inertiajs/react";
import AppLayout from "@/Layouts/AppLayout";

const Show = () => {
    const { property } = usePage().props;
    console.log(property);

    return (
        <>
            <h1 className="font-semibold text-2xl text-gray-800 leading-tight">
                Property Details
            </h1>
            {/*smaller*/}
            <h2 className="font-semibold text-xl text-gray-800 leading-tight">
                {property.name}
            </h2>
            {/*smaller*/}
            <h2 className="font-semibold text-xl text-gray-800 leading-tight">
                {property.address.street_and_number}
            </h2>
        </>
    );
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
