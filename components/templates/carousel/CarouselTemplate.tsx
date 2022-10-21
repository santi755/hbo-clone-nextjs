import { Swiper, SwiperSlide } from 'swiper/react';
import { Navigation, Pagination } from 'swiper';
import Image from 'next/image';

import 'swiper/css';
import 'swiper/css/navigation';
import 'swiper/css/pagination';
import styles from './CarouselTemplate.module.css';
export interface ICarouselTemplate {
  sampleTextProp: string;
}

const CarouselTemplate: React.FC<ICarouselTemplate> = ({ sampleTextProp }) => {
  return (
    <Swiper
      className={styles.carousel}
      modules={[Navigation, Pagination]}
      spaceBetween={0}
      slidesPerView={1}
      onSlideChange={() => console.log('slide change')}
      onSwiper={(swiper) => console.log(swiper)}
      navigation
      pagination={{ clickable: true }}
    >
      <SwiperSlide>
        <Image src="/assets/images/carousel/serie1-3840x2160.jpg" alt="HBO MAX" width="3840" height="2160" />
      </SwiperSlide>
      <SwiperSlide>
        <Image src="/assets/images/carousel/serie2-3840x2160.jpg" alt="HBO MAX" width="3840" height="2160" />
      </SwiperSlide>
      <SwiperSlide>
        <Image src="/assets/images/carousel/serie3-3840x2160.jpg" alt="HBO MAX" width="3840" height="2160" />
      </SwiperSlide>
    </Swiper>
  );
};

export default CarouselTemplate;