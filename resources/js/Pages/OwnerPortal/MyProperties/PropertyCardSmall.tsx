import React from "react";
import { router } from "@inertiajs/react";
import route from "ziggy-js";

interface PropertyCardSmallProps {
    id: number;
    name: string;
    street_and_number: string;
}
const PropertyCardSmall: React.FC<PropertyCardSmallProps> = (props) => {
    const handleRoute = () => {
        router.get(
            route("my-properties.show", props.id),
            {},
            {
                preserveScroll: true,
                preserveState: true,
            }
        );
    };
    return (
        <div
            onClick={handleRoute}
            className="flex flex-col lg:flex-row lg:space-x-6 cursor-pointer hover:bg-gray-50 border-b border-gray-200 shadow-sm"
        >
            <div className="flex-auto ml-3 justify-evenly py-2">
                <div className="flex flex-wrap ">
                    <h2 className="flex-auto text-lg font-medium">
                        {props.name}
                    </h2>
                </div>
                <p className="mt-3">{/* Add content here */}</p>
                <div className="flex flex-wrap ">
                    <h2 className="flex-auto text-lg font-medium">
                        {props.street_and_number}
                    </h2>
                </div>
            </div>
        </div>
    );
};

export default PropertyCardSmall;
