export interface FootStep {
    height: number;
    width: number;
    rotate: number;
    footToesActive: boolean;
    footHeelActive: boolean;
}

export interface Step {
    howQuick: number;
    man: {
        leftFoot: FootStep;
        rightFoot: FootStep;
    };
    woman: {
        leftFoot: FootStep;
        rightFoot: FootStep;
    };
}

export interface FootAnimationProps {
    currentStep: Step | null;
    loaderIsVisible: boolean;
    danceStepCounter: number;
    danceStepLength: number;
    autoplayVariable: string;
    danceName: string;
}

export interface FootAnimationEmits {
    'backToBeginBtn': void;
    'backBtn': void;
    'autoplayBtn': void;
    'nextBtn': void;
    'backToEndBtn': void;
}