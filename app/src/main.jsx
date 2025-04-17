import { StrictMode } from 'react'
import { createRoot } from 'react-dom/client'
import {BrowserRouter, Route, Router, Routes} from "react-router-dom";
import './main.css'
import App from './App.jsx'
import Header from "./components/Header.jsx";

createRoot(document.getElementById('root')).render(
  <BrowserRouter>
    <App/>
  </BrowserRouter>,
)
