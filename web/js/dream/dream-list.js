$(document).ready(function(){
	let dreamListApp = new Vue({
		el: '#dream-list-app',
		data: {
			dreams: [],

			resultsPerPage: 10,
			currentPage: 0,
			lastPage: null,
			totalPages: 1,

			searchOnLoad: false,

			filter: '',
			lastFilter: null
		},
		mounted: function () {
			if(this.searchOnLoad) {
				this.search();
			}
		},
		methods: {
			loadResults: function(data) {
				this.dreams = data.results;
				this.totalPages = Number.parseInt(Math.ceil(data.total / this.resultsPerPage));
			},

			prev: function() {
				if(this.currentPage >  0) {
					this.lastPage = this.currentPage;
					this.currentPage--;
					this.search();
				}
			},

			next: function() {
				if(this.currentPage + 1 < this.totalPages) {
					this.lastPage = this.currentPage;
					this.currentPage++;
					this.search();
				}
			},

			search: function() {
				//Don't repeat a search
				if(this.filter === this.lastFilter && this.currentPage === this.lastPage) {
					return;
				}

				let self = this;
				$.ajax({
					url: '/search/list',
					method: 'GET',
					data: {
						'DreamForm[limit]': this.resultsPerPage,
						'DreamForm[page]': this.currentPage,
						'DreamForm[search]': this.filter
					},
					success: function (data) {
						self.lastFilter = self.filter;
						self.loadResults(data);
					},
					error: function (error) {
						console.log(error);
					}
				});
			}
		}
	});
});