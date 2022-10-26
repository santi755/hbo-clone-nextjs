import Image from 'next/image';
import Link from 'next/link';
import styles from './HeaderTemplate.module.css';
import { CgMenu } from "react-icons/cg";

export interface IHeaderTemplate {
  sampleTextProp: string;
}

const HeaderTemplate: React.FC<IHeaderTemplate> = ({ sampleTextProp }) => {
  return (
    <div className={styles.header}>
      <div>
        <button>
          <CgMenu></CgMenu>
        </button>
        <Link href="/movies">
          <a>Movies</a>
        </Link>
        <Link href="/series">
          <a>Series</a>
        </Link>
      </div>
      <div>
        <Image src="/assets/images/logo/hbo-max.png" alt="HBO MAX" width="134" height="23" />
      </div>
      <div>Menu right - {sampleTextProp}</div>
    </div>
  );
};

export default HeaderTemplate;