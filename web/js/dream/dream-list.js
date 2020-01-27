$(document).ready(function(){
	let dreamListApp = new Vue({
		el: '#dream-list-app',
		data: {
			dreams: [],
			resultsPerPage: null,
			currentPage: null,
			totalPages: null,
			searchOnLoad: false
		},
		mounted: function () {
			if(this.searchOnLoad) {
				this.search();
			}
		},
		methods: {
			loadResults: function(data) {
				this.dreams = data.results;
				this.totalPages = data.total;
			},

			prev: function() {
				if(this.currentPage < this.totalPages) {
					this.currentPage++;
					this.search();
				}
			},

			next: function() {
				if(this.currentPage > 0) {
					this.currentPage--;
					this.search();
				}
			},

			search: function() {
				let self = this;
				$.ajax({
					url: '/search/list',
					method: 'GET',
					data: {
						'DreamForm[limit]': this.resultsPerPage,
						'DreamForm[page]': this.currentPage,
						'DreamForm[search]': 'airplane'
					},
					success: function (data) {
						self.loadResults(data);
					},
					error: function (error) {
						console.log(error);
					}
				});
			}
		}
	});

	dreamListApp.search();
});