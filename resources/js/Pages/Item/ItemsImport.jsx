import React, { useState } from "react";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";
import { Head } from "@inertiajs/react";

export default function ItemEdit({ auth, errors }) {
    const [json, setJson] = useState(null);
    return (
        <AuthenticatedLayout
            user={auth.user}
            header={
                <h2 className="font-semibold text-xl text-gray-800 leading-tight">
                    Import items
                </h2>
            }
        >
            <Head title="List" />

            <div className="py-12">
                <div className="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div className="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div className="p-6 text-gray-900">
                            <div>
                                <form
                                    action={"/list/import"}
                                    method="POST"
                                    enctype="multipart/form-data"
                                    className="flex items-center space-x-4"
                                >
                                    <input
                                        type="hidden"
                                        name="_token"
                                        value={document
                                            .querySelector(
                                                'meta[name="csrf-token"]'
                                            )
                                            .getAttribute("content")}
                                    />
                                    <label className="text-sm text-gray-700">
                                        JSON File:
                                    </label>
                                    <input
                                        type="file"
                                        accept=".json"
                                        name="json"
                                        onChange={(e) =>
                                            setJson("json", e.target.files[0])
                                        }
                                        className="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                    />
                                    <button
                                        type="submit"
                                        className="px-2 py-1 bg-orange-500 text-white rounded hover:bg-orange-700"
                                    >
                                        Import Items
                                    </button>
                                </form>
                                {errors.json && (
                                    <p className="text-red-500">
                                        {errors.json}
                                    </p>
                                )}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </AuthenticatedLayout>
    );
}
