import { BrowserRouter, Route, Routes,  } from 'react-router-dom';
import './App.css';
import Signin from "./pages/Signin"
import Homepage from './Homepage';


function App() {
  return (
       <BrowserRouter>
      <Routes>
        <Route path='/' element={<Signin/>} />
        <Route path="/homepage" >
          <Route index element={<Homepage/>} />
        </Route>
        <Route path='*' element={<h1>404</h1>} />
      </Routes>
    </BrowserRouter>
  );
}

export default App;
