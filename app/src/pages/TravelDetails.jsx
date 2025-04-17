import React from "react";
import data from "../datas/data.json"
import {useParams} from "react-router-dom";
import Gauge from "../components/Gauge.jsx";



const TravelDetails = () =>{

    const id = useParams().travelId
    const travel = data.find(r => (String(r.id) === id))

    let spentSum = travel.budget;

    // travel.participant.forEach((user)=>{
    //     spentSum += parseFloat(user.budget)
    // })

    const userParticipation = travel.participant.map((user)=>{
        const participation = parseFloat(user.budget) * 100 / spentSum
        return {
            name:user.name,
            budget : user.budget,
            participation : participation
        }
    })

    console.log(userParticipation)

    return(
        <>
            <h1 className="text-3xl font-bold text-center m-5 text-gray-900 mb-8">{travel.name}</h1>

            <div className="max-w-2xl w-full m-auto border-t border-gray-300 dark:border-gray-600 my-6"></div>
            <div className="max-w-2xl w-full my-8 p-6 bg-gray-50 dark:bg-gray-800 rounded-xl shadow-md">
                <div className="space-y-6">
                    {userParticipation.map((user) => (
                        <div
                            key={`${user.name}-${user.participation}`}
                            className="p-4 bg-white dark:bg-gray-700 rounded-lg shadow flex flex-col md:flex-row md:items-center md:justify-between gap-4"
                        >
                            <div className="flex flex-col md:flex-row md:items-center md:gap-6">
                                <p className="text-lg font-semibold text-gray-800 dark:text-white">{user.name}</p>
                                <p className="text-gray-600 dark:text-gray-300">{user.budget} €</p>
                            </div>
                            <Gauge value={user.participation}/>
                        </div>
                    ))}
                </div>
            </div>
            <div className="max-w-2xl w-full m-auto border-t border-gray-300 dark:border-gray-600 my-6"></div>
            <h2 className="text-3xl font-bold text-start m-5 text-gray-900 mb-8">Rembourser un participant</h2>
        </>
    )


}

export default TravelDetails