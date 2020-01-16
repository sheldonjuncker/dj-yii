$(document).ready(function(){
	let dreamCommentApp = new Vue({
		el: '#dream-comment-app',
		data: {
			newComment: '',
			comments: []
		},
		methods: {
			addComment: function () {
				let now = new Date();
				this.comments.push({
					'author': 'Sheldon Juncker',
					'date': now.getFullYear()+'/'+(now.getMonth()+1)+'/'+now.getDate(),
					'text':  this.newComment
				});
				this.newComment = '';
			}
		}
	});
});