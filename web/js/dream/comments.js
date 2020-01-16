$(document).ready(function(){
	let dreamCommentApp = new Vue({
		el: '#dream-comment-app',
		data: {
			message: 'Hello, world!',
			comments: [
				{
					'author': 'Sheldon Juncker',
					'date': '11/25/1994',
					'text': 'Hello, world!'
				},
				{
					'author': 'Your Therapist',
					'date': '11/25/1994',
					'text': 'Bye.'
				}
			]
		}
	});
});