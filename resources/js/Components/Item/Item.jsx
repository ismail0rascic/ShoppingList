import { Inertia } from "@inertiajs/inertia";
import { FaTrash, FaPencilAlt, FaCheck } from "react-icons/fa";

export default function Item({ item, user }) {
    const deleteItem = async (id) => {
        Inertia.delete(`/item/${id}`);
    };
    const editItem = async (id) => {
        Inertia.get(`/item/${id}/edit`);
    };
    const markAsBought = async (id) => {
        Inertia.post(`/item/${id}/mark-as-bought`);
    };

    return (
        <div className="flex flex-col md:flex-row bg-white shadow overflow-hidden sm:rounded-lg p-4 mb-4">
            <div className="flex-grow">
                <h2
                    className={`text-lg leading-6 font-medium ${
                        item.is_bought
                            ? "line-through text-gray-400"
                            : "text-gray-900"
                    }`}
                >
                    {item.description}
                </h2>
                <p className="mt-1 text-sm text-gray-500">User: {user?.name}</p>
                <p className="mt-1 text-sm text-gray-500">
                    Date: {new Date(item.created_at).toLocaleDateString()}
                </p>
            </div>
            <div className="mt-4 md:mt-0 md:flex md:items-center md:justify-end space-x-3">
                <button
                    className="px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500"
                    onClick={() => deleteItem(item.id)}
                >
                    <FaTrash />
                </button>
                {!item.is_bought && (
                <button
                    className="px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
                    onClick={() => editItem(item.id)}
                >
                    <FaPencilAlt />
                </button>
                )}
                {!item.is_bought && (
                    <button
                        className="px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500"
                        onClick={() => markAsBought(item.id)}
                    >
                        <FaCheck />
                    </button>
                )}
            </div>
        </div>
    );
}
