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
        postPerLoad: 1,
        pageLength: 0
    },
    computed: {
        // portfolio() {
        //     let pages = this.paginate(this.portfolioData, 1)
        //     return pages[this.seeMoreIdx]
        // }
    },
    methods: {
        seeMore() {
            if(this.seeMoreIdx < this.pageLength-1) {
                this.seeMoreIdx++
                this.portfolio.push(this.getPaginate(this.seeMoreIdx)[0])
                const _self = this
                setTimeout(function() {
                    _self.waitForImages()
                },300)
            }
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
            var rupiah = '';		
            var angkarev = angka.toString().split('').reverse().join('');
            for(var i = 0; i < angkarev.length; i++) if(i%3 == 0) rupiah += angkarev.substr(i,3)+'.';
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
            var grid = document.getElementsByClassName('masonry')[0],
                rowGap = parseInt(window.getComputedStyle(grid).getPropertyValue('grid-row-gap')),
                rowHeight = parseInt(window.getComputedStyle(grid).getPropertyValue('grid-auto-rows'));
            var rowSpan = Math.ceil((item.querySelector('.masonry-content').getBoundingClientRect().height+rowGap)/(rowHeight+rowGap));
            item.style.gridRowEnd = 'span '+rowSpan;
            item.querySelector('.masonry-content').style.height = rowSpan * 10 + "px";
        },
        waitForImages() {
            const _self = this
            var allItems = document.getElementsByClassName('masonry-item');
            for(let i=0;i<allItems.length;i++){
              imagesLoaded( allItems[i], function(instance) {
                var item = instance.elements[0];
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
                    _self.waitForImages()
                },200)
            }
        }
    },
    mounted(){
        this.$nextTick(() => {
            const _self = this
            _self.initSwiperJumbotron()
            _self.initSwiperWork()
            _self.fetchPortfolioData()
        });
    },
})