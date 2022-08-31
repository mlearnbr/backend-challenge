import cryptoRandomString from 'crypto-random-string';
import { useHistory } from 'react-router-dom';
import React, { useState } from 'react';
import Form from 'react-bootstrap/Form';
import Button from 'react-bootstrap/Button';
import backEndNode from '../api/backEndApi';

function FormUsers() {
  const [username, setUsername] = useState('');
  const [phoneNumber, setPhoneNumber] = useState('');
  const [accessLevel, setAccessLevel] = useState('');
  const [password, setPassword] = useState('');
  const history = useHistory();

  const handleClick = async () => {
    const externalId = cryptoRandomString({ length: 7 });
    await backEndNode.post('user', {
      msisdn: phoneNumber,
      name: username,
      access_level: accessLevel,
      password,
      external_id: externalId,
    }).then((res) => console.log(res));
  };

  return (
    <Form>
      <h1>Cadastro de usuários</h1>
      <Form.Group className="mb-3">
        <Form.Label>Nome</Form.Label>
        <Form.Control
          type="string"
          placeholder="Nome completo"
          onChange={({ target }) => setUsername(target.value)}
        />
      </Form.Group>

      <Form.Group className="mb-3">
        <Form.Label>Celular</Form.Label>
        <Form.Control
          type="string"
          placeholder="ex: 5531999999999"
          onChange={({ target }) => setPhoneNumber(`+${target.value}`)}
        />
      </Form.Group>

      <Form.Group className="mb-3">
        <Form.Label>Nível de acesso</Form.Label>
        <Form.Control
          type="string"
          placeholder="free, pro ou premium"
          onChange={({ target }) => setAccessLevel(target.value)}
        />
      </Form.Group>

      <Form.Group className="mb-3">
        <Form.Label>Senha</Form.Label>
        <Form.Control
          type="password"
          placeholder="Password"
          onChange={({ target }) => setPassword(target.value)}
        />
      </Form.Group>

      <Button
        variant="warning"
        type="button"
        onClick={handleClick}
      >
        Cadastrar
      </Button>
      <Button
        className="m-3"
        variant="warning"
        type="button"
        onClick={() => history.push('/list')}
      >
        Ver usuários cadastrados
      </Button>
    </Form>
  );
}

export default FormUsers;
