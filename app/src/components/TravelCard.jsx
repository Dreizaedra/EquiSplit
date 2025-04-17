import { Link } from "react-router-dom";

const TravelCard = ({ travel }) => {
    return (
        <div
            key={`travel-${travel.id}-${travel.name}`}
            className="flex flex-row w-80 gap-6 p-6 m-3 rounded-lg shadow-md bg-white dark:bg-gray-900"
        >
            <section className="flex flex-col flex-1">
                <h5 className="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                    {travel.name}
                </h5>
                <p className="mb-2 font-normal text-gray-700 dark:text-gray-400">
                    Dépenses totales du voyage :{" "}
                    <span className="font-medium">{travel.budget} €</span>
                </p>
                <p className="font-normal text-gray-700 dark:text-gray-400">
                    Nombre de participants :{" "}
                    <span className="font-medium">{travel.participant.length}</span>
                </p>
            </section>

            <Link
                to={`/travels/${travel.id}`}
                className="h-fit self-end inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
            >
                Voir plus <i className="fa-solid fa-arrow-right ml-2"></i>
            </Link>
        </div>
    );
};

export default TravelCard;


