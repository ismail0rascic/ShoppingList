import { Inertia } from "@inertiajs/inertia";

export default function ListButtons({}) {
    const addItem = async () => {
        Inertia.get("/item/create");
    };
    const importItems = async () => {
        Inertia.get("/list/import");
    };
    const exportItems = async () => {
        Inertia.get("/list/export");
    };
    return (
        <div className="flex justify-start my-4 space-x-3">
            <button
                className="px-4 py-2 bg-purple-500 text-white rounded hover:bg-purple-700"
                onClick={() => addItem()}
            >
                Add Item
            </button>
            <button
                className="px-4 py-2 bg-yellow-500 text-white rounded hover:bg-yellow-700"
                onClick={() => importItems()}
            >
                Import
            </button>
            <button
                className="px-4 py-2 bg-green-500 text-white rounded hover:bg-green-700"
                onClick={() => exportItems()}
            >
                Export
            </button>
        </div>
    );
}
