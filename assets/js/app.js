new Vue({
    el: '#page',
    data: {
        sideMenuOpen: false,
        swiperJumbotron: '',
        swiperWork: '',
        tabWorkDetail: 0,
        portfolioData: [],
        seeMoreIdx: 0,
        portfolio: [],
        tempPortfolio: [],
        postPerLoad: 1,
        pageLength: 0,
        categoriesByProject: [],
        categoriesByYear: [],
        filterType: 'year',
        filterByProject: 'All',
        filterByYear: 'All',
        alphabets: ['a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z'],
        showAlphaFilter: false,
        pickedAlpha: 'A',
        runFilter: 'none',
        tax: '',
        pcAlpha: ''
    },
    methods: {
        pickAlpha(alpha) {
            this.pickedAlpha = alpha
            this.showAlphaFilter = false
        },
        seeMore() {
            if(this.seeMoreIdx < this.pageLength-1) {
                this.seeMoreIdx++
                if(this.runFilter === 'none') {
                    this.portfolio.push(this.getPaginate(this.seeMoreIdx)[0])
                }
                else if(this.runFilter === 'alpha') {
                    this.portfolio.push(this.getPaginateByAlphabet(this.pcAlpha, this.seeMoreIdx)[0])
                } else {
                    this.portfolio.push(this.getPaginateByCat(this.tax, this.seeMoreIdx)[0])
                }
                const _self = this
                setTimeout(function() {
                    _self.renderingMasonry()
                },300)
            }
        },
        getCategories() {
            let catsByProject = []
            let catsByYear = []
            for(let i=0;i<this.portfolioData.length;i++) {
                for(let j=0;j<this.portfolioData[i].terms.length;j++) {
                    this.portfolioData[i].terms[j].label === 'portfolio_year' ? catsByYear.push(this.portfolioData[i].terms[j].value) : catsByProject.push(this.portfolioData[i].terms[j].value)
                }
            }
            this.categoriesByProject = [...new Set(catsByProject)]
            this.categoriesByYear = [...new Set(catsByYear)]
        },
        paginate (arr, size) {
            return arr.reduce((acc, val, i) => {
                let idx = Math.floor(i / size)
                let page = acc[idx] || (acc[idx] = [])
                page.push(val)
            
                return acc
            }, [])
        },
        getPaginate(idx) {
            console.log('get paginate')
            let pages = this.paginate(this.portfolioData, this.postPerLoad)
            this.pageLength = pages.length
            return pages[idx]
        },
        getPaginateByCat(cat, idx) {
            console.log('get paginate by cat')
            let pages = this.paginate(this.portfolioData.filter(d => d.terms.some(x => x.value === cat)), this.postPerLoad)
            this.pageLength = pages.length
            return pages[idx]
        },
        getPaginateByAlphabet(alp, idx) {
            console.log('get paginate by alpha')
            let pages = this.paginate(this.portfolioData.filter(d => d.author.charAt(0).toUpperCase() == alp.toUpperCase()), this.postPerLoad)
            this.pageLength = pages.length
            return pages[idx]
        },
        convertToRupiah(angka) {
            let rupiah = '';		
            let angkarev = angka.toString().split('').reverse().join('');
            for(let i = 0; i < angkarev.length; i++) if(i%3 == 0) rupiah += angkarev.substr(i,3)+'.';
            return 'Rp '+rupiah.split('',rupiah.length-1).reverse().join('');
        },
        initSwiperJumbotron() {
            this.swiperJumbotron = new Swiper(".swiper--jumbotron", {
                autoplay: {
                    delay: 2500,
                    disableOnInteraction: true,
                },
                pagination: {
                    el: ".swiper--jumbotron--pagination",
                },
                navigation: {
                    nextEl: ".swiper--jumbotron--next",
                    prevEl: ".swiper--jumbotron--prev",
                }
            });
        },
        initSwiperWork() {
            this.swiperWork = new Swiper(".swiper--work", {
                observer: true,
                observeParents: true,
                navigation: {
                    nextEl: ".swiper--work--next",
                    prevEl: ".swiper--work--prev",
                }
            });
        },
        resizeMasonryItem(item){
            let grid = document.getElementsByClassName('masonry')[0],
                rowGap = parseInt(window.getComputedStyle(grid).getPropertyValue('grid-row-gap')),
                rowHeight = parseInt(window.getComputedStyle(grid).getPropertyValue('grid-auto-rows'));
            let rowSpan = Math.ceil((item.querySelector('.masonry-content').getBoundingClientRect().height)/(rowHeight+rowGap));
            item.style.gridRowEnd = 'span '+rowSpan;
            item.querySelector('.masonry-content').style.height = rowSpan * 10 + "px";
        },
        renderingMasonry() {
            const _self = this
            let allItems = document.getElementsByClassName('masonry-item');
            for(let i=0;i<allItems.length;i++){
              imagesLoaded( allItems[i], function(instance) {
                let item = instance.elements[0];
                _self.resizeMasonryItem(item);
              } );
            }
        },
        fetchPortfolioData() {
            const _self = this
            axios
              .get('/kiba-itb/wp-json/kiba/v1/portfolio/')
              .then(({ data }) => {
                _self.portfolioData = data
                _self.getCategories()
              })
              .catch( error => console.log(error))
        }
    },
    watch: {
        portfolioData() {
            const _self = this
            if(this.portfolioData.length) {
                this.portfolio = this.getPaginate(0)
                setTimeout(function() {
                    _self.renderingMasonry()
                },200)
            }
        },
        filterByProject() {
            const _self = this
            this.portfolio = []
            this.seeMoreIdx = 0
            setTimeout(function() {
                if(_self.filterByProject === 'All') {
                    _self.runFilter = 'none'
                    _self.portfolio = _self.getPaginate(0)
                } else {
                    _self.runFilter = 'tax'
                    _self.tax = _self.filterByProject
                    _self.portfolio = _self.getPaginateByCat(_self.filterByProject, 0)
                }
                setTimeout(function() {
                    _self.renderingMasonry()
                },100)
            }, 100)
        },
        filterByYear() {
            const _self = this
            this.portfolio = []
            this.seeMoreIdx = 0
            setTimeout(function() {
                if(_self.filterByProject === 'All') {
                    _self.runFilter = 'none'
                    _self.portfolio = _self.getPaginate(0)
                } else {
                    _self.runFilter = 'tax'
                    _self.tax = _self.filterByYear
                    _self.portfolio = _self.getPaginateByCat(_self.filterByYear, 0)
                }
                setTimeout(function() {
                    _self.renderingMasonry()
                },100)
            }, 100)
        },
        pickedAlpha() {
            const _self = this
            _self.portfolio = []
            this.seeMoreIdx = 0
            setTimeout(function() {
                _self.runFilter = 'alpha'
                _self.pcAlpha = _self.pickedAlpha
                _self.portfolio = _self.getPaginateByAlphabet(_self.pickedAlpha, 0)
                setTimeout(function() {
                    _self.renderingMasonry()
                },100)
            }, 100)
        }
    },
    mounted(){
        this.$nextTick(() => {
            this.initSwiperJumbotron()
            this.initSwiperWork()
            this.fetchPortfolioData()
        });
    },
})