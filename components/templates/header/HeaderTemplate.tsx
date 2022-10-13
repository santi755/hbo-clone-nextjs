import styles from './HeaderTemplate.module.css';

export interface IHeaderTemplate {
  sampleTextProp: string;
}

const HeaderTemplate: React.FC<IHeaderTemplate> = ({ sampleTextProp }) => {
  return <div className={styles.container}>{sampleTextProp}</div>;
};

export default HeaderTemplate;