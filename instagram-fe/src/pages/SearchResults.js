import React from "react";
import { useLocation } from "react-router-dom";

function SearchResults() {
  const location = useLocation();
  const users = location.state.users;

  return (
    <div>
      <h1>Search Results</h1>
      <ul className="search-results-list">
        {users.map((user) => (
          <li key={user.id} className="user-card">
            <img
              className="user-image"
              src={user.image ? user.image : "default-image-url"}
              alt={user.username}
            />
            <div className="user-details">
              <h3 className="user-name">{user.name}</h3>
              <p className="user-username">@{user.username}</p>
            </div>
          </li>
        ))}
      </ul>
    </div>
  );
}

export default SearchResults;
