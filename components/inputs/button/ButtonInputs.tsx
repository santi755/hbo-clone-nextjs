import styles from './ButtonInputs.module.css';

export interface IButtonInputs {
  sampleTextProp: string;
}

const ButtonInputs: React.FC<IButtonInputs> = ({ sampleTextProp }) => {
  return <button className={styles.container}>{sampleTextProp}</button>;
};

export default ButtonInputs;