import axios from 'axios';

const backEndNode = axios.create({
  baseURL: 'http://localhost:3001/',
});

export default backEndNode;
