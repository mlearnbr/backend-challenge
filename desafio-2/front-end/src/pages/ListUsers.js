import React, { useContext } from 'react';
import Button from 'react-bootstrap/Button';
import ListGroup from 'react-bootstrap/ListGroup';
import backEndNode from '../api/backEndApi';
import AppContext from '../context/AppContext';

function ListUsers() {
  const { users } = useContext(AppContext);

  const onClickUpgrade = async (id) => {
    await backEndNode.put(`user/${id}/upgrade`);
    window.location.reload();
  };

  const onClickDowngrade = async (id) => {
    await backEndNode.put(`user/${id}/downgrade`);
    window.location.reload();
  };

  return (
    users.length === 0 ? <div>Carregando...</div>
      : Object.values(users).map(({
        _id: id, name, msisdn, access_level: accLev,
      }) => (
        <ListGroup horizontal={name} className="my-2" key={id}>
          <ListGroup.Item>{name}</ListGroup.Item>
          <ListGroup.Item>{msisdn}</ListGroup.Item>
          <ListGroup.Item>
            {accLev}
            <Button
              variant="secondary"
              onClick={() => onClickUpgrade(id)}
              className="ms-5"
            >
              Upgrade

            </Button>
            <Button
              variant="secondary"
              className="mx-1"
              onClick={() => onClickDowngrade(id)}
            >
              Downgrade

            </Button>
          </ListGroup.Item>
        </ListGroup>
      ))
  );
}

export default ListUsers;
