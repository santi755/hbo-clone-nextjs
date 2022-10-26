import styles from './ButtonUi.module.css';

export interface IButtonUi {
  sampleTextProp: string;
}

const ButtonUi: React.FC<IButtonUi> = ({ sampleTextProp }) => {
  return <button className={styles.container}>{sampleTextProp}</button>;
};

export default ButtonUi;