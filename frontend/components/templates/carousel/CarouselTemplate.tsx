import { Swiper, SwiperSlide } from 'swiper/react';
import { Navigation, Pagination } from 'swiper';
import Image from 'next/image';
import { CgChevronLeft, CgChevronRight } from "react-icons/cg";

import 'swiper/css';
import 'swiper/css/pagination';
import styles from './CarouselTemplate.module.css';
export interface ICarouselTemplate {
  sampleTextProp: string;
}

const CarouselTemplate: React.FC<ICarouselTemplate> = ({ sampleTextProp }) => {

  const seriesList = [
    { id: 0, name: 'serie1',background: 'serie1-3840x2160.jpg', title: 'serie1-title.png', width: 600, height: 181, description: 'SEASON FINALE ON MONDAY', subdescription: 'The brutal story of succession of a different kind.'},
    { id: 1, name: 'serie2',background: 'serie2-3840x2160.jpg', title: 'serie2-title.png', width: 600, height: 181, description: 'SEASON FINALE ON MONDAY', subdescription: 'The brutal story of succession of a different kind.'},
    { id: 2, name: 'serie3',background: 'serie3-3840x2160.jpg', title: 'serie3-title.png', width: 600, height: 181, description: 'SEASON FINALE ON MONDAY', subdescription: 'The brutal story of succession of a different kind.'},
  ];

  const swiperParams = {
    className: styles.swiperContainerSlider,
    modules: [Navigation, Pagination],
    spaceBetween: 0,
    slidesPerView: 1,
    navigation: { nextEl: "#swiperNext", prevEl: "#swiperPrev" },
    pagination: { clickable: true },
    allowTouchMove: false,
  };

  return (
    <div className={styles.swiperContainer}>
      <Swiper {...swiperParams}>
        <button id="swiperPrev" className={`${styles.slideButton} ${styles.slideButtonLeft}`}>
          <CgChevronLeft className={styles.slideButtonIcon}/>
        </button>
        <button id="swiperNext" className={`${styles.slideButton} ${styles.slideButtonRight}`}>
          <CgChevronRight className={styles.slideButtonIcon}/>
        </button>
        {seriesList.map(serie => (
          <SwiperSlide key={serie.id}>
            <div>
              <Image
                src={`/assets/images/carousel/${serie.background}`}
                alt="background"
                width="3840"
                height="2160"
              />
              <div className={styles.sliderTitle}>
                <Image
                  className={styles.sliderTitleImage}
                  src={`/assets/images/carousel/${serie.title}`}
                  alt={serie.name}
                  width={serie.width}
                  height={serie.height}
              />
                <p className={styles.sliderTitleDescription}>{serie.description}</p>
                <p className={styles.sliderTitleSubdescription}>{serie.subdescription}</p>
                <div className={styles.sliderTitleInteraction}>
                  <button>Play</button>
                  <button>MORE INFO</button>
                </div>
              </div>
            </div>
            <div className={`${styles.swiperOpacity} ${styles.swiperOpacityFirst}`}></div>
            <div className={`${styles.swiperOpacity} ${styles.swiperOpacitySecond}`}></div>
            <div className={`${styles.swiperOpacity} ${styles.swiperOpacityThird}`}></div>
            <div className={`${styles.swiperOpacity} ${styles.swiperOpacityFourth}`}></div>
            <div className={`${styles.swiperOpacity} ${styles.swiperOpacityFifth}`}></div>
          </SwiperSlide>
        ))}
      </Swiper>
    </div>
  );
};

export default CarouselTemplate;