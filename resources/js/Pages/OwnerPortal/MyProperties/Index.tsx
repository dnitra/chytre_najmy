import { Link, usePage } from "@inertiajs/react";
import route from "ziggy-js";
import PropertyCardSmall from "@/Pages/OwnerPortal/MyProperties/PropertyCardSmall";
import React from "react";

type MyProperties = {
    id: number;
    name?: string;
    address: {
        street_and_number: string;
        city?: string;
        country: {
            name: string;
        };
    };
};

export default function Index() {
    const { myProperties } = usePage().props as unknown as {
        myProperties: Array<MyProperties>;
    };
    return (
        <div className="py-6">
            <h1 className="font-semibold text-2xl text-gray-800 leading-tight">
                My Properties
            </h1>
            <div className="mt-4">
                <Link
                    href={route("my-properties.create")}
                    className="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
                >
                    Add New Property
                </Link>
            </div>
            {myProperties.map((property: any) => (
                <PropertyCardSmall
                    key={property.id}
                    id={property.id}
                    name={property.name}
                    street_and_number={property.address.street_and_number}
                />
            ))}
        </div>
    );
}
