import styles from './NavbarTemplate.module.css';

export interface INavbarTemplate {
  sampleTextProp: string;
}

const NavbarTemplate: React.FC<INavbarTemplate> = ({ sampleTextProp }) => {
  return <div className={styles.container}>{sampleTextProp}</div>;
};

export default NavbarTemplate;