import React from "react";

const Gauge = ({value}) => {

const clampedValue = Math.max(-100, Math.min(100, value));
const widthPercent = Math.abs(clampedValue);


    return (
        <div className="w-full max-w-sm mx-auto">
            <div className="relative h-4 bg-gray-200 dark:bg-gray-600 rounded-full overflow-hidden">
                <div className="absolute left-1/2 top-0 bottom-0 w-0.5 bg-gray-400 dark:bg-gray-300 z-10"></div>
                {clampedValue < 0 && (
                    <div
                        className="absolute left-1/2 top-0 bottom-0 bg-red-500"
                        style={{width: `${widthPercent / 2}%`, transform: "translateX(-100%)"}}
                    ></div>
                )}
                {clampedValue > 0 && (
                    <div
                        className="absolute left-1/2 top-0 bottom-0 bg-green-500"
                        style={{width: `${widthPercent / 2}%`}}
                    ></div>
                )}
            </div>

            <div className="text-center mt-2 text-sm font-medium text-gray-700 dark:text-gray-300">
                {clampedValue >= 0 ? "Crédit" : "Dette"} : {clampedValue.toFixed(2)} %
            </div>
        </div>


    )
}

export default Gauge