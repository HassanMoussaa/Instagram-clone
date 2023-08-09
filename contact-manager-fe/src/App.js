import { BrowserRouter, Route, Routes,  } from 'react-router-dom';
import './App.css';
import Contacts from "./pages/Contacts"
import Signin from "./pages/Signin"
import AddContact from "./pages/AddContact"
import ContactDetails from "./pages/ContactDetails"

function App() {
  return (
       <BrowserRouter>
      <Routes>
        <Route path='/' element={<Signin/>} />
        <Route path="/contacts" >
          <Route index element={<Contacts/>} />
        </Route>
        <Route path='/contacts/add' element={<AddContact/>} /> 
         <Route path='/ContactDetails/:id' element={<ContactDetails/>} /> 
        <Route path='*' element={<h1>404</h1>} />
      </Routes>
    </BrowserRouter>
  );
}

export default App;
