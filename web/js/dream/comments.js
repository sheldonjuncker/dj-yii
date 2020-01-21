$(document).ready(function(){
	Vue.component('comment', {
		props: ['comment'],
		template: `
			<div class="dream comment row">
				<div class="col-lg-8">
					<b>{{ comment.author }}</b>
				</div>
				<div class="col-lg-4">
					<i>{{ comment.date }}</i>
				</div>
				<div class="col-lg-12">
					<p>{{ comment.text }}</p>
					<input type="hidden" :name="'Dream[comment][' + comment.id + ']'" :value="comment.text" :id="'DreamComment_' + comment.id" />
				</div>
				<div class="col-lg-12">
					<button class="btn btn-sm btn-warning" v-on:click="editComment('{{ comment.id }}')">Edit</button>
					<button class="btn btn-sm btn-danger">Delete</button>
				</div>
			</div>
		`
	});

	let dreamCommentApp = new Vue({
		el: '#dream-comment-app',
		data: {
			newCounter: 0,
			text: '',
			title: '',
			buttonTitle: '',
			commentId: '',
			mode: '', // new|edit
			comments: [
				{
					'id': 0,
					'author': 'Sheldon Juncker',
					'date': '11.25.1994',
					'text':  'Hello, world!'
				}
			]
		},
		methods: {
			newComment: function () {
				this.resetModalOptions();
				this.mode = 'new';
				this.setModalOptions();
				$('#commentModel').modal('show');
			},

			editComment: function(commentId) {
				this.mode = 'edit';
				this.text = $('#DreamComment_' + commentId).val();
				this.commentId = comentId;
				this.setModalOptions();
				$('#commentModel').modal('show');
			},

			resetModalOptions: function () {
				this.mode = '';
				this.text = '';
				this.title = '';
				this.buttonTitle = '';
				this.commentId = '';
			},

			setModalOptions: function () {
				if(this.mode === 'new') {
					this.title = 'New Comment';
					this.buttonTitle = 'Add';
				}
				else {
					this.title = 'Edit Comment';
					this.buttonTitle = 'Edit';
				}
			},

			saveComment: function () {
				if(this.mode === 'new') {
					let now = new Date();
					this.comments.push({
						'id': 'new-' + this.newCounter++,
						'author': 'Sheldon Juncker',
						'date': now.getFullYear()+'/'+(now.getMonth()+1)+'/'+now.getDate(),
						'text':  this.text
					});
				}
				else {
					for(let i=0;i<this.comments.length;i++) {
						if(this.comments[i].id == this.commentId) {
							this.comments[i].text = this.text;
							break;
						}
					}
				}
				this.resetModalOptions();
			},
		}
	});
});