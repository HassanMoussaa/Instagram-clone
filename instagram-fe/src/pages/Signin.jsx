import React, { useState } from "react";
import { useNavigate } from "react-router-dom";
import axios from "axios";
import Cookies from "js-cookie";
import "./Signin.css";

const Signin = () => {
  const navigate = useNavigate();
  const [email, setEmail] = useState("");
  const [password, setPassword] = useState("");

  const submit = async () => {
    const result = await axios.post("http://127.0.0.1:8000/api/login", {
      email,
      password,
    });
    if (result.data.message === "success") {
      Cookies.set("jwt_token", result.data.authorization.token, { expires: 1 });
      navigate("/Homepage");
    }
  };

  const signUp = () => {
    navigate("/signup");
  };

  return (
    <div className="signin_container">
      <div>
        <h2>Sign In</h2>
        <input
          type="text"
          value={email}
          placeholder="Email"
          onChange={(e) => {
            setEmail(e.target.value);
          }}
        />
      </div>
      <div>
        <input
          type="password"
          value={password}
          placeholder="Password"
          onChange={(e) => {
            setPassword(e.target.value);
          }}
        />
      </div>
      <div className="signin_signup">
        <div>
          <button onClick={submit}>Submit</button>
        </div>
        <div>
          <button onClick={signUp}>Sign Up</button>
        </div>
      </div>
    </div>
  );
};

export default Signin;
