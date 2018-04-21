
var express = require('express');
var router = express.Router();
var ctrlMain  = require("../controllers/cntrlMain");
var modelMain = require("../models/modelMain");

console.log("Router:"); console.log(router);


/*
  GET home page.
 */
router.get('/', ctrlMain.home);

/*
 * GET player list page.
 */
router.get('/playerlist', modelMain.get_playerlist);

/*
 * GET new player page.
 */
router.get('/newplayer', ctrlMain.get_newplayer);


/*
 * GET show player page.
 */
router.get('/playerlist/:player', modelMain.get_showplayer);

/*
 * GET delete player page.
 */
router.get('/deleteplayer/:player', ctrlMain.get_deleteplayer);

/*
 * POST delete user page.
 */
router.post('/deleteplayer/:player', modelMain.post_deleteplayer);


/*
 * POST add player page.
 */
router.post('/addplayer', modelMain.post_addplayer);
///*
// * POST update player page.
// */
//router.post('/playerlist/:player', ctrlMain.post_updateplayer);
//

module.exports = router;