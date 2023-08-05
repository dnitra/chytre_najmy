import MyProperties from "../MyProperties";
import AppLayout from "@/Layouts/AppLayout";
import route from "ziggy-js";
import { useForm } from "@inertiajs/react";

const Create = () => {
    const { data, setData, post, processing, errors } = useForm({
        property_type_id: "",
        city: "",
        country_id: "",
        street_and_number: "",
        zip_code: "",
    });

    function handlePost(e) {
        e.preventDefault();
        post(route("my-properties.store"));
    }
    return (
        <>
            <h1>Create Property</h1>(
            <form onSubmit={handlePost} className="p-4 bg-gray-100">
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
                        <option value="">Select Property Type</option>
                        <option value="1">Apartment</option>
                        <option value="2">House</option>
                        <option value="3">Office</option>
                    </select>
                    {errors.property_type_id && (
                        <div className="text-red-500">
                            {errors.property_type_id}
                        </div>
                    )}
                </div>
                <div className="mb-4">
                    <label
                        htmlFor="city"
                        className="block font-semibold text-gray-700"
                    >
                        City
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
                        Country
                    </label>
                    <select
                        id="country_id"
                        className="form-select mt-1 block w-full"
                        value={data.country_id}
                        onChange={(e) =>
                            setData({ ...data, country_id: e.target.value })
                        }
                    >
                        <option value="">Select Country</option>
                        <option value="1">Czech Republic</option>
                        <option value="2">Slovakia</option>
                        <option value="3">Other</option>
                    </select>
                    {errors.country_id && (
                        <div className="text-red-500">{errors.country_id}</div>
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
