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
        postPerLoad: 10,
        pageLength: 0,
        categoriesByProject: [],
        categoriesByYear: [],
        filterType: 'year',
        filterByProject: 'All',
        filterByYear: 'All',
        alphabets: ['a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z'],
        showAlphaFilter: false,
        pickedAlpha: 'a'
    },
    methods: {
        pickAlpha(alpha) {
            this.pickedAlpha = alpha
            this.showAlphaFilter = false
        },
        seeMore() {
            if(this.seeMoreIdx < this.pageLength-1) {
                this.seeMoreIdx++
                this.portfolio.push(this.getPaginate(this.seeMoreIdx)[0])
                this.tempPortfolio.push(this.getPaginate(this.seeMoreIdx)[0])
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
            let pages = this.paginate(this.portfolioData, this.postPerLoad)
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
                this.tempPortfolio = this.getPaginate(0)
                setTimeout(function() {
                    _self.renderingMasonry()
                },200)
            }
        },
        filterByProject() {
            const _self = this
            this.portfolio = []
            setTimeout(function() {
                _self.portfolio = _self.filterByProject === 'All' ? _self.tempPortfolio : _self.tempPortfolio.filter(d => d.terms.some(x => x.value === _self.filterByProject))
                setTimeout(function() {
                    _self.renderingMasonry()
                },100)
            }, 100)
        },
        filterByYear() {
            const _self = this
            this.portfolio = []
            setTimeout(function() {
                _self.portfolio = _self.filterByYear === 'All' ? _self.tempPortfolio : _self.tempPortfolio.filter(d => d.terms.some(x => x.value === _self.filterByYear))
                setTimeout(function() {
                    _self.renderingMasonry()
                },100)
            }, 100)
        },
        pickedAlpha() {
            const _self = this
            _self.portfolio = []
            setTimeout(function() {
                _self.portfolio = _self.tempPortfolio.filter(d => d.author.charAt(0).toUpperCase() == _self.pickedAlpha.toUpperCase())
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