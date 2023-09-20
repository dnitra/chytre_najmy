import React from "react";

interface PropertyCardSmallProps {
    name: string;
    street_and_number: string;
    city: string;
}
const PropertyCardSmall: React.FC<PropertyCardSmallProps> = (props) => {
    return (
        <div className="flex flex-col lg:flex-row lg:space-x-6 cursor-pointer hover:bg-gray-50 border-b border-gray-200 shadow-sm">
            <div className="flex-auto ml-3 justify-evenly py-2">
                <div className="flex flex-wrap ">
                    <div className="flex-auto text-lg font-medium">
                        {props.name}
                    </div>
                </div>
                <div className="flex flex-wrap ">
                    <div className="flex-auto text-lg font-medium">
                        {props.city}
                    </div>
                </div>
                <div className="flex flex-wrap ">
                    <div className="w-full flex-none text-sm font-medium text-gray-500 mt-2">
                        {props.street_and_number}
                    </div>
                </div>
            </div>
        </div>
    );
};

export default PropertyCardSmall;
