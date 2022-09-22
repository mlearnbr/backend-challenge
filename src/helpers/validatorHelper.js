const validationResult = require('express-validator').validationResult;

module.exports = {  
    check(req, res, next) {
      const errors = validationResult(req);

      if (!errors.isEmpty()) {
        return res.status(400).json({ message: errors.array() });
      }
      return next();
    }
}
