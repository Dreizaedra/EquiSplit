import './App.css'
import {Route, Routes} from "react-router-dom";
import Home from "./pages/Home.jsx";
import Budget from "./pages/Budget.jsx";
import MainLayout from "./layouts/MainLayout.jsx";
import NoteBook from "./pages/NoteBook.jsx";
import Participant from "./pages/Participant.jsx";
import Travels from "./pages/Travels.jsx";
import TravelDetails from "./pages/TravelDetails.jsx";

function App() {


  return (
    <MainLayout>
        <Routes>
            <Route path={"/"} element={<Home/>}/>
            <Route path={"/budget"} element={<Budget/>}/>
            <Route path={"/travels"} element={<Travels/>}/>
            <Route path={"/travels/:travelId"} element={<TravelDetails/>}/>
            <Route path={"/noteBook"} element={<NoteBook/>}/>
            <Route path={"/participant"} element={<Participant/>}/>
        </Routes>
    </MainLayout>
  )
}

export default App
