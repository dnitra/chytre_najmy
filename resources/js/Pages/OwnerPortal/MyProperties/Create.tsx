import MyProperties from "../MyProperties";
import React from "react";
import AppLayout from "@/Layouts/AppLayout";
import route from "ziggy-js";
import { useForm, usePage } from "@inertiajs/react";

const Create = () => {
    const { data, setData, post, processing, errors } = useForm({
        property_type_id: "",
        city: "",
        country_id: "",
        street_and_number: "",
        zip_code: "",
    });

    const { propertyTypes, countries } = usePage().props;

    function handlePost(e) {
        e.preventDefault();
        post(route("my-properties.store"));
    }
    return (
        <>
            <h1
                className={"font-semibold text-2xl text-gray-800 leading-tight"}
            >
                Create a new property
            </h1>
            <form onSubmit={handlePost} className="p-4 bg-gray-100">
                <div className="mb-4">
                    <label
                        htmlFor="city"
                        className="block font-semibold text-gray-700"
                    >
                        *City
                    </label>
                    <input
                        type="text"
                        id="city"
                        className="form-input mt-1 block w-full"
                        value={data.city}
                        onChange={(e) =>
                            setData({ ...data, city: e.target.value })
                        }
                    />
                    {errors.city && (
                        <div className="text-red-500">{errors.city}</div>
                    )}
                </div>
                <div className="mb-4">
                    <label
                        htmlFor="country_id"
                        className="block font-semibold text-gray-700"
                    >
                        *Country
                    </label>
                    <select
                        id="country_id"
                        className="form-select mt-1 block w-full"
                        value={data.country_id}
                        onChange={(e) =>
                            setData({ ...data, country_id: e.target.value })
                        }
                    >
                        <option disabled={true} value="">
                            {" "}
                            Select a country
                        </option>
                        {countries.map((country) => (
                            <option key={country.id} value={country.id}>
                                {country.name}
                            </option>
                        ))}
                    </select>
                    {errors.country_id && (
                        <div className="text-red-500">{errors.country_id}</div>
                    )}
                </div>
                <div className="mb-4">
                    <label
                        htmlFor="property_type_id"
                        className="block font-semibold text-gray-700"
                    >
                        Property Type
                    </label>
                    <select
                        id="property_type_id"
                        className="form-select mt-1 block w-full"
                        value={data.property_type_id}
                        onChange={(e) =>
                            setData({
                                ...data,
                                property_type_id: e.target.value,
                            })
                        }
                    >
                        <option disabled={true} value="">
                            {" "}
                            Select a property type
                        </option>
                        {propertyTypes.map((propertyType) => (
                            <option
                                key={propertyType.id}
                                value={propertyType.id}
                            >
                                {propertyType.name}
                            </option>
                        ))}
                    </select>
                    {errors.property_type_id && (
                        <div className="text-red-500">
                            {errors.property_type_id}
                        </div>
                    )}
                </div>
                <div className="mb-4">
                    <label
                        htmlFor="street_and_number"
                        className="block font-semibold text-gray-700"
                    >
                        Street and Number
                    </label>
                    <input
                        type="text"
                        id="street_and_number"
                        className="form-input mt-1 block w-full"
                        value={data.street_and_number}
                        onChange={(e) =>
                            setData({
                                ...data,
                                street_and_number: e.target.value,
                            })
                        }
                    />
                    {errors.street_and_number && (
                        <div className="text-red-500">
                            {errors.street_and_number}
                        </div>
                    )}
                </div>
                <div className="mb-4">
                    <label
                        htmlFor="zip_code"
                        className="block font-semibold text-gray-700"
                    >
                        Zip Code
                    </label>
                    <input
                        type="number"
                        id="zip_code"
                        className="form-input mt-1 block w-full"
                        value={data.zip_code}
                        onChange={(e) =>
                            setData({ ...data, zip_code: e.target.value })
                        }
                    />
                    {errors.zip_code && (
                        <div className="text-red-500">{errors.zip_code}</div>
                    )}
                </div>
                <button
                    type="submit"
                    className="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded disabled:bg-gray-400"
                    disabled={processing}
                >
                    {processing ? "Creating..." : "Create"}
                </button>
            </form>
        </>
    );
};

Create.layout = (page: any) => (
    <AppLayout title="My Properties" subtitle="My Properties">
        <MyProperties children={page} />
    </AppLayout>
);

export default Create;
