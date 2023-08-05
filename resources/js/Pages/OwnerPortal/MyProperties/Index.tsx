import { Link, usePage } from "@inertiajs/react";
import React from "react";
import route from "ziggy-js";

export default function Index() {
    const { properties } = usePage().props;
    console.log(usePage().props);
    console.log(properties);

    return (
        <div className="py-6">
            <h2>List of Properties</h2>
            <Link href={route("my-properties.create")}>Create</Link>
            <br />
            <Link href={route("my-properties.show", 1)}>Property 1</Link>
            <br />
            <Link href={route("my-properties.show", 2)}>Property 2</Link>
        </div>
    );
}
