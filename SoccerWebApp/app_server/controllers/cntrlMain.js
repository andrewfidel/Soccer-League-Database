/*
 * GET home page.
 */
module.exports.home = function(req, res) 
{
    res.render('index', { "title": 'MongoDB-Express' });
};

/*
 * GET new user page.
 */
module.exports.get_newplayer = function(req, res) 
{
    res.render('newplayer', { "title": 'Add New player' });
};

/*
 * GET delete user page.
 */
module.exports.get_deleteplayer = function(req, res) 
{
    var playername = req.params.firstName;
    res.render('deleteplayer', { "player_name" : playername} );
};