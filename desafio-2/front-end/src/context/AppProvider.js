import React, { useEffect, useState } from 'react';
import PropTypes from 'prop-types';
import AppContext from './AppContext';
import backEndNode from '../api/backEndApi';

function AppProvider({ children }) {
  const [users, setUsers] = useState([]);

  useEffect(() => {
    backEndNode.get('/user').then((res) => setUsers(res.data));
  }, []);

  const context = {
    users,
    setUsers,
  };

  return (
    <AppContext.Provider value={context}>
      {children}
    </AppContext.Provider>
  );
}

AppProvider.propTypes = {
  children: PropTypes.node.isRequired,
};

export default AppProvider;
