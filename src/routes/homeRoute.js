const express = require('express');
const router = express.Router();
const homeController = require('../controllers/homeController');
const homeValidator = require('../validators/homeValidator');
const ValidatorHelper = require('../helpers/validatorHelper');

router.get('/', homeController.get);
router.post('/', homeValidator.postRules, ValidatorHelper.check, homeController.post);

module.exports = router;