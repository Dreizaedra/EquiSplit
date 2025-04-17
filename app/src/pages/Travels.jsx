import React, {useEffect, useState} from "react";
import TravelCard from "../components/TravelCard.jsx";
import {getAllTravel} from "../request/travel.js";

//TODO : Importer les voyage depuis la bdd




const Travels = () => {

    const [filter, setFilter] = useState("all");
    const [travels, setTravels] = useState([]);



    useEffect(() => {

        getAllTravel()
    }, []);


let filteredTravel = travels;

if(filter !== "all"){
    filteredTravel = filteredTravel.filter((travel)=>(travel.status === filter))
}


    return (
        <>
            <div className="flex flex-row flex-wrap p-4 items-center justify-between">
                <div className="mb-4">
                    <select
                        id="travelStatus"
                        className="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        onChange={(e)=>setFilter(e.target.value)}>
                        <option value="all" selected>Status du voyage</option>
                        <option value="inProgress">En cours</option>
                        <option value="archive">Archivé</option>
                    </select>
                </div>
                <div className="mb-4">
                    <a href="#" className="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Ajouter un nouveau voyage</a>
                </div>
            </div>
            <div className={"flex flex-row justify-center flex-wrap"}>
                {filteredTravel.map(travel=>(
                    <TravelCard key={travel.id} travel={travel}/>
                ))}
            </div>
        </>
    )
}

export default Travels