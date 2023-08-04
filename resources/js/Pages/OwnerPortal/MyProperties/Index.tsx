import React from "react";
import { usePage } from '@inertiajs/react';

export default function Index(){

    const properties = usePage().props
    console.log(properties)

    return <div className="py-6">List of Properties</div>;
}
