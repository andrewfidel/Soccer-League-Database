/*
 * GET player list page.
 */
module.exports.get_playerlist = function(req, res) 
{
    var db = req.db;
    var player_collection = db.get('player');
   
    player_collection.find({}, {}, 
                    function(err, docs)
                    {
                        res.render('playerlist', { 'playerlist' : docs });
    	                  //console.log("Success");
                    });
};

/*
 * GET show player page.
 */
module.exports.get_showplayer = function(req, res) 
{
    var _playername = req.params.player;
    var db = req.db;
    var player_collection = db.get('player');
    
    player_collection.find( { player : _playername }, 
                     function(err, doc) 
                     {
                         if (err) {
                             res.send("Find failed.");
                         }
                         else {
                             res.render('showplayer', 
                                        { title: 'Show Player: ' + _playername,
                                          mail: doc[0].firstName });
                         }
                     });
};

///*
// * POST add player page.
// */
//module.exports.post_addplayer = function(req, res) 
//{
//    // Set our internal DB variable
//    var db = req.db;
//
//    // Get our form values. These rely on the "name" attributes.
//    var playernamefirst = req.body.playernamefirst;
//    var playernamelast = req.body.playernamelast;
//
//    // Set our collection.
//    var collection = db.get('player');
//
//    // Submit to the database.
//    collection.insert( { "firstName" : playernamefirst,
//                         "lastName" : playernamelast },
//                       function (err, doc) 
//                       {
//                           if (err) {
//                               res.send("Insert failed.");
//                           }
//                           else {
//                               // Forward to success page
//                               res.redirect("playerlist");
//                           }
//                       });
//};
//
///*
// * POST delete player page.
// */
//module.exports.post_deleteplayer = function(req, res) 
//{
//    //var uname = req.params.username;
//    var _playername = req.params.player;
//   
//    var db = req.db;
//    var player_collection = db.get('player');
//
//    // Submit to the database.
//    player_collection.remove( { "playername" : _playername },
//                       function (err, doc) 
//                       {
//                           if (err) {
//                               res.send("Delete failed.");
//                           }
//                           else {
//                               res.send("Successfully deleted " + _playername);
//                           }
//                       });
//};