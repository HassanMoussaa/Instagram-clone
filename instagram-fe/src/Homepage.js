import React, { useState, useEffect } from "react";
import Sidenav from './navigation/Sidenav'
import Timeline from './timeline/Timeline'
import "./Homepage.css"
import Cookies from "js-cookie";
import { useNavigate } from "react-router-dom";
import axios from "axios";

function Homepage() {
  return (
    <div className='homepage'>
      <div className='homepage__nav'>
        <Sidenav />
        </div>    
      <div className='homepage__timeline'>
        <Timeline /> 
        </div>    
    </div>
  )
}

export default Homepage
