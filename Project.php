{{> head }}
<body>
	{{> navbar }}
	{{{ body }}}
	{{{> footer }}}
</body>
</html>
<!DOCTYPE html>
<head>
	<meta name="viewport" content="width=device-width,initial-scale=1.0">
	<link rel = "stylesheet" href = "/general.css">
	<link href = "https://fronts.googleapis.com/css2?family=Kaushan+Script&family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<title>{{tittle}}</tittle>
</head>

<header class = "header">
	<div class = "conteiner">
		<div class = "header_inner">
			<div class = "header_logo"><a href = "/">GetId</a></div>
				<nav class = "nav">
				
					<a class = "nav_link" href = "/getList">Швидкий список</a>
					{{#if isAuth}}
						<a class = "nav_link" href = "/add">СФормувати список</a>
						<a class = "nav_link" href = "/userLists">Мої списки</a>
						<a class = "nav_link" href = "/auth/logout">Вийти</a>
					{{else}}
						<a class = "nav_link" href = "/auth/login">Увійти</a>
					{{/if}}
					
				</nav>
			</div>
		</div>
	</header>
	
<script src="/addFields.js"></script>
<script src="/deleteFields.js"></script>
<script src="/login.js"></script>
const {Schema, model} = require('mongoose');

const userSchema = new Schema({
	name: {
	    type: String,
	    required: true,
	},
	password: {
		type: String,
		required: true,
	},
	userData: {
		items: [{
			tittle: {
				type: String,
				required: true,
			},
		}],
	},
	groupToken: {
	    type: String,
	}
}0;

	router.get('/logout', async(req, res) =>{
	req.session.destroy( ()=>{
		res.redirect('/auth/login');
	});
});

	router.post('login', loginValidators, async (req, res) =>{
		try {
			const{name, password} = req.body;
			
			const errors = validationResult(req);
			if(!errors.isEmpty()){
				req.flash('regError', errors.array()[0].msg;
				return res.status(422).rediirect('/auth/login')
			}
			const candidate = await User.findOne({name});
			req.session.user =candidate;
			req.session.isAuthenticated = true;
			req.session.save(error => {
				if(error){
					throw error;
				}
				res.redirect('/userLists');
				})
				
				} catch (error) {
					console.log(error);
					}
					
					});
			module.exportst = function(req, res, next){
				if(!req.session.isAuthenticated){
					return res.redirect('/auth/login');
				}
					
				next();
			}
	router.post('/register', registerValidators, astnc (req, res) =>
			try{
		const{name, passsword} =  req.dody;
		if(!errors.isEmpty()){
			req.flash('regError', errors.array()[0].msg);
			return res.status(422).redirect('/auth/login')
		}
		const hashPassword = await bcrypt.hash(password, 10)
		const user = new User({
			name, password: hashPassword, lists: {items: []}
		});
		await user. save():
		res.redirect('/auth/login);
	
	}catch(error){
		console.log(error);
		}
	})
			module.exports = function(req, res, next) {
				res.locals.isAuth = req.session.isAuthenticated;
				res.locals.csrf = req.csrfToken();
				next();
			}
		
	<form class = "inputGroup" id = "pasteFacebookLink" action ="/add" method ="post">
	<input id =tittle" type ="text" class = "inputField" name = "tittle" placeholder = "Назва списку" required value="{{data.tittle}}">
	<input id =tittle" type ="text" class = "inputField" name = "link" placeholder = "Посилання на пост" required value="{{data.link}}">
				
	<input type = "hidden" name = "_csrf" value = "{{csrf}}">
				
	<button class = "submitButton" id = "buttonVk">Сформувати</button>
	</form>
			
	exports.registerValidators = [
	body('name').custom(async (value, {req}) => {
	try {
	const user = await User.findOne({name: value});
	if(user){
		return Promise.reject('Користувач вже існує');
	}
	})
	.isLenght({min: 2})
	.withMessage('ім'я не може містити менше 2 символів')
	.trim(),
				
	body('password','Пароль не може бути менше 6 символів')
	.isLength({min: 6, max: 56})
	.isAlphanumeric()
	.trim(),
				
	body('confirm').custom(async (value,{req}) => {
		if(value !== req.body.password){
			throw new Error('Паролі не збігаються');
			}
				return true;
				})
				.trim(),
				];
	module.exports ={
		MONGODB_URI: process.env.MONGODB_URI,
		SESSION_SECRET: process.env.SESSION_SECRET,
		}
		if(process.env.NODE_ENV === 'production'){
			module.exports = require('./keys.prod');
			} else{
				module.exports = require('./keys.dev');
				}
				
	router.get('/',auth, async (req, res) => {
	const user = await req.user.populate('userData.items');
	const lists = user.userData. items.map(l => ){
		...l._doc
		}));
	res.render('userLists', {
		tittle: 'My lists',
			lists
			});
					
	router.get('/:id/edit', auth, async (req, res) => {
		if(!req.query.allow){
			return res.redirect('/');
			}
	router.get('/:id/edit', auth, async (req, res) => {
		if(!req.query.allow){
			return res.redirect('/');
			}
		let list = await req.user.findListId(req.params.id);
			list = list._doc;
		res.render('list-edit', {
			tittle: `Редактувати ${list.tittle}`,
				list,
				});
				});
					
	router.post('edit', auth, async (req, res) => {
		await req.user.update(req.body);
		res.redirect('/userLists');
		})
				
				