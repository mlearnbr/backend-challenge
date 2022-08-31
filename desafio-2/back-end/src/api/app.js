const express = require('express');
const cors = require('cors');
const routes = require('../routes/router');
const middlewares = require('../middlewares');

const app = express();

app.use(express.json({ limit: '50mb' }));
app.use(express.urlencoded({ limit: '50mb' }));
app.use(cors());

// teste api
app.get('/ping', (_req, res) => res.status(200).json({ message: 'pong' })); 

app.use('/user', routes.userRouter);

app.use(middlewares.error);

module.exports = app;